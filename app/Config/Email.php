<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail  = 'sinotik3@gmail.com';  
    public string $fromName   = 'notulen';               
    public string $recipients = '';                   

    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';

    // Konfigurasi SMTP Gmail
    public string $SMTPHost = 'smtp.gmail.com';       
    public string $SMTPUser = 'sinotik3@gmail.com'; 
    public string $SMTPPass = 'rwto ztql tcks cooq';   // Ganti dengan App Password
    public int $SMTPPort = 587;                       
    public int $SMTPTimeout = 10;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';               // Gunakan TLS

    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';                
    public string $charset = 'UTF-8';
    public bool $validate = true;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    // Debugging
    public bool $SMTPDebug = true; // Ubah ke false jika tidak ingin melihat log SMTP
}
