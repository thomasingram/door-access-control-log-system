<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
    /**
     * @param  string       $email
     * @param  string       $plainPassword
     * @return object|false
     */
    public function getLoginUser($email, $plainPassword)
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return false;
        }

        $isPasswordValid = $this->isCorrectPlainPassword($user, $plainPassword);

        return $isPasswordValid ? $user : false;
    }

    /**
     * @param  string      $email
     * @return object|null
     */
    public function getUserByEmail($email)
    {
        $users = $this->db->where('email', $email)
            ->limit(1)
            ->get('dacls_user')
            ->result();

        if (count($users) === 0) {
            return null;
        }

        return array_pop($users);
    }

    /**
     * @param  object  $user
     * @param  string  $plainPassword
     * @return boolean
     */
    private function isCorrectPlainPassword($user, $plainPassword)
    {
        return crypt($plainPassword, $user->salt) === $user->password;
    }
}
