<?php      
   $messageImage = '';                            
   $moved   = false;                          
   $dot = '../';
   $path= '';
   $title = '';
   $songName = '';
   $genre = '';
   $recap = '';
   $content = '';
   $author = '';
   $messageTitle = '';
   $messageSongName = '';
   $messageRecap = '';
   $messageGenre = '';
   $messageAuthor = '';
   if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        if(isset($_POST['txtTitle']) and !empty($_POST['txtTitle'])){$title = $_POST['txtTitle'];}
        else{$messageTitle = 'Bạn chưa nhập tiêu đề';}
        if(isset($_POST['txtSongName']) and !empty($_POST['txtSongName'])){$songName = $_POST['txtSongName'];}
        else{$messageSongName = 'Bạn chưa nhập tên bài hát';}
        if(isset($_POST['genre']) and !empty($_POST['genre'])){$genre = $_POST['genre'];}
        else{$messageGenre = 'Bạn chưa chọn thể loại';}
        if(isset($_POST['txtRecap']) and !empty($_POST['txtRecap'])){$recap = $_POST['txtRecap'];}
        else{$messageRecap = 'Bạn chưa nhập tóm tắt';}
        $content = $_POST['txtContent'];
        if(isset($_POST['author']) and !empty($_POST['author'])){$author = $_POST['author'];}
        else{$messageAuthor = 'Bạn chưa chọn tác giả';}
        if ($_FILES['image']['error'] === 0) {  
            // Store temporary path and new destination
            $temp = $_FILES['image']['tmp_name'];
            $path = 'images/songs/' . $_FILES['image']['name'];
            // Move the file and store result in $moved
            $moved = move_uploaded_file($temp, $dot.$path);
        }
   }
?>