<?php

require_once('DbConaction.php');

/**
 * Class User
 */
class User
{
    /** add user to database
     * @param string $email
     * @param int $status
     * @return bool|string
     */
    public function addUser(string $email, int $status = 1)
    {
        if (!$this->checkEmail($email)) {
            $sql = "INSERT INTO `users`(`email`,`status`) VALUES (:email,:status)";
            query($sql, ['email' => $email, 'status' => $status]);
        } else {
            return "this email is already in use";
        }

        return true;
    }

    /**
     * @param int|null $id
     * @param string|null $email
     * @return bool|mixed
     */
    public function getUser(int $id = null, string $email = null)
    {
        if (is_null($id) && is_null($email)) {
            return false;
        }

        $queryFild = !is_null($id) ? 'id' : 'email';
        $sql = "SELECT * FROM `users` WHERE status IN(1,2) AND $queryFild=:$queryFild";
        $respons = query($sql, [$queryFild => $id ?? $email]);
        $result = $respons->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param string $email
     * @param int $status
     * @return bool
     */
    public function changeUserStatus(string $email, int $status = 1)
    {
        if (!$this->checkEmail($email, [1, 2])) {
            $sql = "UPDATE `users` SET `status`=:status WHERE email:email";
            $respons = query($sql, ['email' => $email, 'status' => $status]);
            return true;
        }
        return false;
    }

    /**
     * checks if mail is busy
     * @param string $email
     * @param array|int[] $status
     * @return bool
     */
    public function checkEmail(string $email, array $status = [1, 2, 3])
    {
        $arrayQuery = implode(',', array_fill(0, count($status), '?'));
        $params = $status;
        array_unshift($params, $email);
        $sql = "SELECT email FROM `users` WHERE email = ? AND status IN($arrayQuery) ";
        $respons = query($sql, $params);
        $result = $respons->fetchAll(PDO::FETCH_ASSOC);

        return count($result) > 0 ? true : false;
    }
}