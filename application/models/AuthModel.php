<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    public function __construct()
    {
        date_default_timezone_set('Europe/Amsterdam');
    }

    public function checkCredentials ($email, $pass) {

        // Try and fetch the user with posted e-mail account
        $this->db->where('email', $email);
        $query = $this->db->get('members');

        // Check if the user exists
        if ($query->num_rows() < 1) { return $this->returnMessage('Foutief gebruikersnaam of wachtwoord'); }
        $user = $query->result()[0];

        // Check if the user is blocked, and if so how long the block remains
        $blocked = $this->checkifBlocked($user);
        if($blocked) { return $blocked; }


        // We got so far, so the user is found and not blocked at the moment.
        // Grab the appropriate salt
        $this->db->where('id', $user->id);
        $query = $this->db->get('salts');
        $salt = $query->result()[0];

        // Check if posted password hashed with the salt matches the one in our user object
        $hashed_input = crypt($pass, '$6$rounds=' . $salt->rounds . '$' . $salt->salt . '$');
        $hashed_input = explode('$', $hashed_input)[4];

        if ($hashed_input == $user->pass) {
            // The password matches, reset the failed attempt counter and return the user object
            $this->clearFailedAttempts($user->id);
            return $user;
        }
        else {
            // The password doesn't match, increment the failed attempt counter
            $this->incrementFailedAttempt($user->id);
            return $this->returnMessage('Foutief gebruikersnaam of wachtwoord');
        }

    }






    public function createSession($userId, $afasMemberId, $username) {
        $this->session->set_userdata('userId', $userId);
        $this->session->set_userdata('afasMemberId', $afasMemberId);
        $this->session->set_userdata('username', $username);
        $this->setSessionToken($userId);

        redirect(base_url('ledenportaal/dashboard'));
    }

    public function destroySession($message = null) {

        $this->session->unset_userdata([
            'userId',
            'afasMemberId',
            'username',
            'sessionToken'
        ]);

        if ($message != null) {
            $message = urldecode($message);
            $this->session->set_flashdata('login_error', $message);
        }

        redirect(base_url());
    }

    public function setSessionToken ($userId) {

        // generate a random token
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        $this->db
            ->where('members_id', $userId)
            ->set('token', $token)
            ->set('timestamp', date('Y-m-d H:i:s', time()))
            ->update('secure_sessions');

        $this->session->set_userdata('sessionToken', $token);
    }

    public function checkTokenValid ($userId) {
        $query = $this->db
            ->where('members_id', $userId)
            ->get('secure_sessions');
        $result = $query->result();

        if ($result) {
            if($this->session->sessionToken == $result[0]->token) {

                // The session token matches the database session token, now check if the last token was set less than 8 minutes ago
                if (strtotime($result[0]->timestamp) > strtotime("-8 minutes")) {

                    // The session is set less than 8 minutes ago, great! No logout necessary
                    return true;
                }
            }
        }
        // Either the sessiontokens didn't match or the token expired
        return false;
    }

    private function checkifBlocked ($user) {

        // Check if the user failed to authenticate more than 3 times
        if ($user->failed_login_attempt >= 3) {

            // Is the latest failed attempt older than 20 minutes?
            if(strtotime($user->blocked_timestamp) > strtotime("-20 minutes")) {

                // Nope, the user failed to authenticate correctly more than 3 times in the last 20 minutes.
                // Calculate the remaining time untill it can be tried again.
                $datetime1 = new DateTime($user->blocked_timestamp);
                $datetime2 = new DateTime('now');
                $interval = $datetime1->diff($datetime2);
                $remaining = 20 - $interval->format('%i');

                // Return an error
                return $this->returnMessage('Uw account is geblokkeerd voor ' . $remaining . ' minuten.');
            }
        }
        // User is not blocked, return false
        return false;
    }

    private function incrementFailedAttempt($userId) {

        // Create a timestamp and increment the failed attempt counter
        $timestamp = date('Y-m-d H:i:s', time());

        $this->db
            ->where('id', $userId)
            ->set('failed_login_attempt', 'failed_login_attempt+1', false)
            ->set('blocked_timestamp', $timestamp)
            ->update('members');
    }

    private function clearFailedAttempts($userId) {

        // Reset the failed attempt counter
        $this->db
            ->where('id', $userId)
            ->set('failed_login_attempt', 0)
            ->update('members');
    }

    private function returnMessage($messageStr) {

        // Create a new stdClass with an error message and return it
        $message = new stdClass();
        $message->error = $messageStr;
        return $message;

    }
    

}