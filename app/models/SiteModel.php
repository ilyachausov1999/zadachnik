<?php


class SiteModel extends Model
{
    private $allowed_types = array(
        'image/png',
        'image/jpeg',
        'image/gif'
    );

    public function getCount($status = 'new')
    {
        return $this->db->query("SELECT count(*) as n FROM tasks")->row['n'];
    }

    public function getTasks($offset, $limit,$sort = 'name') {
        $sql = "SELECT * FROM tasks order by $sort";
        if($limit != 0) {
            $sql .= $this->db->escape(" LIMIT $offset, $limit");
        }
        $data = $this->db->query($sql);
        return $data->rows;
    }

    public function getTask($id = 0) {
        $sql = "SELECT * FROM tasks WHERE id = ".(int)$id;

        $data = $this->db->query($sql);
        return $data->row;
    }

    public function save() {
        $result = false; //Это для return
        $filename = '';
        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
            $filename = $this->upload_file();
        }
        $name = $this->db->escape($_POST['name']);
        $email = $this->db->escape($_POST['email']);
        $text = $this->db->escape($_POST['text']);
        $sql = "INSERT INTO `tasks` (`id`, `name`, `email`, `text`,`image`,`status`) VALUES (NULL, '$name', '$email', '$text','$filename', 'new')";
        if($this->db->query($sql)) {
            $result = true;
        }

        return $result;
    }

    public function set_status($id = 0, $status = 'new')
    {
        $sql = "UPDATE tasks SET status = '$status' WHERE id = ".(int)$id;
        $this->db->query($sql);

    }

    public function upload_file()
    {
        $mime = mime_content_type($_FILES['image']['tmp_name']);
        //array_search($mime,$this->allowed_types) не работает для png, мистика
        if($mime == 'image/png' or $mime == 'image/jpeg' or $mime == 'image/gif') {
            //Разбить имя файла
            $tmp = explode('.',$_FILES['image']['name']);
            //Вытащить разрешение
            $new_filename = uniqid().'.'.end($tmp);
            if(move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_PATH.$new_filename)) {
                $resized_img = $this->_resize($new_filename, end($tmp));
            } else {
                die('Ошибка загрузки файла, проверьте права на папку');
            }
        }
        return $resized_img;

    }

    private function _resize($filename,$ext) {
        #print_r($ext);die();
        $width = 320;
        $height = 240;
        list($width_orig, $height_orig) = getimagesize(UPLOAD_PATH.$filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
            $height = $width/$ratio_orig;
        }

        $image_p = imagecreatetruecolor($width, $height);
        if($ext == 'jpg' or $ext == 'jpeg')
        {
            $image = imagecreatefromjpeg(UPLOAD_PATH.$filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagejpeg($image_p, UPLOAD_PATH.'resized-'.$filename, 100);
        } elseif($ext == 'png')
        {
            $image = imagecreatefrompng(UPLOAD_PATH.$filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagepng($image_p, UPLOAD_PATH.'resized-'.$filename);
        } else {
            $image = imagecreatefromgif(UPLOAD_PATH.$filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
            imagegif($image_p, UPLOAD_PATH.'resized-'.$filename, 100);
        }
        return UPLOAD_PATH.'resized-'.$filename;
    }
}