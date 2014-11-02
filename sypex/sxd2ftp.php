<?php

// Sypex Dumper 2 FTP-uploader
// Jobs to upload  
// 0 - only saved jobs
// 1 - all jobs
// 'my_job_1, my_job_2' - specified jobs

// /usr/bin/php /var/www/okyjiuct/data/www/walhall.ru/sxd/index.php -j=walhall >/dev/null 2>&1
$jobs_to_upload = 1;

if (!empty($this->JOB['file_name'])) {
    // FTP-server config
    $ftp_server = 'ftp.selcdn.ru';
    $remote_path = 'walhall/'.date("d-m-Y", time()).'/';
    $ftp_user_name = '21931';
    $ftp_user_pass = 'Shwud6g8bF';
    $error_to = 'okyjiuct@gmail.com'; // Email for errors

    $ftp_port = 21;
    // Upload file
    $execute = false;
    if (is_string($jobs_to_upload)) {
        $jobs_to_upload = array_map('trim', explode(',', $jobs_to_upload));
        if (in_array($this->JOB['job'], $jobs_to_upload))
            $execute = true;
    }
    elseif (($jobs_to_upload === 0 && isset($this->JOB['title'])) || $jobs_to_upload == 1) {
        $execute = true;
    }

    if ($execute) {
        $ftp = ftp_connect($ftp_server, $ftp_port, 20);
        ftp_pasv($ftp, true); // Passive mode
        ftp_login($ftp, $ftp_user_name, $ftp_user_pass);
        if (!ftp_put($ftp, $remote_path . $this->JOB['file'], $this->JOB['file_name'], FTP_BINARY)) {
            // Error uploading
            mail($error_to, 'FTP-upload error', "There was a problem while uploading {$this->JOB['file']} to {$ftp_server}.", "From: dumper@sypex.net\nContent-Type: text/plain; charset=utf-8");
        }
        ftp_close($ftp);
    }
}
