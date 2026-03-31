<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
	public string $fromEmail  = 'admin-pbb@sapapadu.pasirlangu.desa.id';
	public string $fromName   = 'SAPAPADU Pasirlangu';
	public string $recipients = '';

	// Gunakan SMTP
	public string $protocol   = 'smtp';
	public string $SMTPHost   = 'sapapadu.pasirlangu.desa.id';
	public string $SMTPUser   = 'admin-pbb@sapapadu.pasirlangu.desa.id';
	public string $SMTPPass   = 'n}Aj2)0{FxSUA=FB'; // <— ubah sesuai password akun email
	public int    $SMTPPort   = 465; // 465=SSL, 587=TLS
	public string $SMTPCrypto = 'ssl'; // ubah ke 'tls' jika pakai port 587

	public string $mailType   = 'html';
	public bool   $validate   = true;
	public string $charset    = 'utf-8';
	public string $newline    = "\r\n";
}
