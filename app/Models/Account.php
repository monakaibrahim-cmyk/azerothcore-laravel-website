<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Account
 * 
 * @property int $id
 * @property string $username
 * @property string $salt
 * @property string $verifier
 * @property string|null $session_key
 * @property varbinary|null $totp_secret
 * @property string $email
 * @property string $reg_mail
 * @property Carbon $joindate
 * @property string $last_ip
 * @property string $last_attempt_ip
 * @property int $failed_logins
 * @property int $locked
 * @property string $lock_country
 * @property Carbon|null $last_login
 * @property int $online
 * @property int $expansion
 * @property int $Flags
 * @property int $mutetime
 * @property string $mutereason
 * @property string $muteby
 * @property int $locale
 * @property string $os
 * @property int $recruiter
 * @property int $totaltime
 *
 * @package App\Models
 */
class Account extends Authenticatable
{
	const ID = 'id';
	const USERNAME = 'username';
	const SALT = 'salt';
	const VERIFIER = 'verifier';
	const SESSION_KEY = 'session_key';
	const TOTP_SECRET = 'totp_secret';
	const EMAIL = 'email';
	const REG_MAIL = 'reg_mail';
	const JOINDATE = 'joindate';
	const LAST_IP = 'last_ip';
	const LAST_ATTEMPT_IP = 'last_attempt_ip';
	const FAILED_LOGINS = 'failed_logins';
	const LOCKED = 'locked';
	const LOCK_COUNTRY = 'lock_country';
	const LAST_LOGIN = 'last_login';
	const ONLINE = 'online';
	const EXPANSION = 'expansion';
	const FLAGS = 'Flags';
	const MUTETIME = 'mutetime';
	const MUTEREASON = 'mutereason';
	const MUTEBY = 'muteby';
	const LOCALE = 'locale';
	const OS = 'os';
	const RECRUITER = 'recruiter';
	const TOTALTIME = 'totaltime';
	protected $connection = 'auth';
	protected $table = 'account';
	public $timestamps = false;

	protected $casts = [
		self::ID => 'int',
		self::SALT => 'binary',
		self::VERIFIER => 'binary',
		self::SESSION_KEY => 'binary',
		self::TOTP_SECRET => 'varbinary',
		self::JOINDATE => 'datetime',
		self::FAILED_LOGINS => 'int',
		self::LOCKED => 'int',
		self::LAST_LOGIN => 'datetime',
		self::ONLINE => 'int',
		self::EXPANSION => 'int',
		self::FLAGS => 'int',
		self::MUTETIME => 'int',
		self::LOCALE => 'int',
		self::RECRUITER => 'int',
		self::TOTALTIME => 'int'
	];

	protected $hidden = [
		self::TOTP_SECRET
	];

	protected $fillable = [
		self::USERNAME,
		self::SALT,
		self::VERIFIER,
		self::EMAIL,
		self::REG_MAIL,
		self::JOINDATE,
		self::EXPANSION,
	];
}
