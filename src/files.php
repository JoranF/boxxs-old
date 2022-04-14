<?php
include_once 'db.php';
class Files
{
    static $info;
    public $db;

    public function __construct()
    {
        $this->db = new db();
        Files::$info = "";
    }

    public function getFilesFromUser($id)
    {
        // get file name and directory from user id
        $target_dir = "../uploads/" . $id . "/";
        $files = scandir($target_dir);
        $files = array_slice($files, 2);
        return $files;
    }

    public function getFileSize($id, $fileName)
    {
        // get file name and directory from user id
        $target_dir = "../uploads/" . $id . "/";
        $file = $target_dir . $fileName;
        $size = filesize($file);
        return $size;
    }

    public function getFileDate($id, $fileName)
    {
        // get file name and directory from user id
        $target_dir = "../uploads/" . $id . "/";
        $file = $target_dir . $fileName;
        $date = date("F d Y H:i:s.", filemtime($file));
        return $date;
    }

    public function getFile($id, $fileName)
    {
        $target_dir = "../uploads/" . $id . "/";
        $file = $target_dir . $fileName;
        return $file;
    }

    public function delete($id, $files)
    {
        $target_dir = "../uploads/" . $id . "/";
        foreach ($files as $fileName) {
            $file = $target_dir . $fileName;
            unlink($file);
        }
        Files::$info =  "File(s) deleted.";
        return Files::$info;
    }

    public function upload($files, $id)
    {
        if (!file_exists("../uploads/" . $id)) {
            mkdir("../uploads/" . $id, 0777, true);
        }
        $countfiles = count($files['fileToUpload']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            $target_dir = "../uploads/" . $id . "/";
            $target_file = $target_dir . basename($files["fileToUpload"]["name"][$i]);
            $uploadOk = 1;
            // Check if file already exists
            if (file_exists($target_file)) {
                Files::$info = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                Files::$info = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($files["fileToUpload"]["tmp_name"][$i], $target_file)) {
                    Files::$info = "Your file(s) has been uploaded.";
                } else {
                    Files::$info = "Sorry, there was an error uploading your file.";
                }
            }
        }
        return Files::$info;
    }

    public function share($owner_id, $shared_email, $files)
    {
        $random_link = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

        $sql = "INSERT INTO shared_files (owner_user_id, shared_user_mail, random_link) VALUES (:owner_user_id, :shared_user_mail, :random_link)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':owner_user_id', $owner_id);
        $stmt->bindParam(':shared_user_mail', $shared_email);
        $stmt->bindParam(':random_link', $random_link);
        $stmt->execute();

        $shared_id = $this->db->conn->lastInsertId();

        foreach ($files as $file) {
            $sql = "INSERT INTO file_box (file_name, shared_files_id) VALUES (:file_name, :shared_files_id)";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bindParam(':file_name', $file);
            $stmt->bindParam(':shared_files_id', $shared_id);
            $stmt->execute();
        }
        return $random_link = "http://localhost/boxxs/public/index.php?shared=" . $random_link;
    }

    public function getsharedFromUser($id)
    {
        $sql = "SELECT * FROM shared_files WHERE owner_user_id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getsharedFromMail($mail)
    {
        $mail = str_replace("@", "%40", $mail);

        $sql = "SELECT * FROM shared_files WHERE shared_user_mail = :mail";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getFileNames($id)
    {
        $sql = "SELECT * FROM file_box WHERE shared_files_id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getFiles($shared_id)
    {
        $sql = "SELECT * FROM file_box WHERE shared_files_id = :shared_files_id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':shared_files_id', $shared_id);
        $stmt->execute();
        $files = $stmt->fetchAll();
        return $files;
    }

    public function deleteSharedid($id)
    {
        $sql = "DELETE FROM shared_files WHERE id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $sql = "DELETE FROM file_box WHERE shared_files_id = :id";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getSharedFiles($link)
    {
        $sql = "SELECT * FROM shared_files WHERE random_link = :random_link";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':random_link', $link);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getDirectory($file_name, $owner_id)
    {
        $target_dir = "../uploads/" . $owner_id . "/";
        $file = $target_dir . $file_name;
        return $file;
    }

    public function archive($names, $shared_files_id)
    {
        foreach ($names as $name) {
            // change archive status to 1
            $sql = "UPDATE file_box SET archived = 1 WHERE file_name = :file_name AND shared_files_id = :shared_files_id";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->bindParam(':file_name', $name);
            $stmt->bindParam(':shared_files_id', $shared_files_id);
            $stmt->execute();
        }
    }

    public function deleteSharedFile($shared_files_id)
    {
        $sql = "DELETE FROM file_box WHERE shared_files_id = :shared_files_id and archived = 1";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bindParam(':shared_files_id', $shared_files_id);
        $stmt->execute();
    }
}
