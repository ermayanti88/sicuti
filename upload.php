<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File ini - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File ini bukan document maupun pdf.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "
    <script>
    alert('Maaf file ini sudah terupload sebelumnya');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "
    <script>
    alert('Maaf file sangat besar');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "docm" && $imageFileType != "dot" && $imageFileType != "docs"
&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" ) {
    echo "
    <script>
    alert('Maaf diupload bukan word/pdf');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "
    <script>
    alert('Maaf file tidak diupload');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo "
    <script>
    alert('Berhasil diupload');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
  } else {
    echo "
    <script>
    alert('Maaf file yang diupload ada kesalahan');
    document.location.href='cuti_diterima_a.php'
    </script>
    ";
  }
}
// 
