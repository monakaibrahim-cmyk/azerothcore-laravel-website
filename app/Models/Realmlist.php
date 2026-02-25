<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Realmlist
 * 
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $localAddress
 * @property string $localSubnetMask
 * @property int $port
 * @property int $icon
 * @property int $flag
 * @property int $timezone
 * @property int $allowedSecurityLevel
 * @property float $population
 * @property int $gamebuild
 *
 * @package App\Models
 */
class Realmlist extends Model
{
	const ID = 'id';
	const NAME = 'name';
	const ADDRESS = 'address';
	const LOCAL_ADDRESS = 'localAddress';
	const LOCAL_SUBNET_MASK = 'localSubnetMask';
	const PORT = 'port';
	const ICON = 'icon';
	const FLAG = 'flag';
	const TIMEZONE = 'timezone';
	const ALLOWED_SECURITY_LEVEL = 'allowedSecurityLevel';
	const POPULATION = 'population';
	const GAMEBUILD = 'gamebuild';
	protected $connection = 'auth';
	protected $table = 'realmlist';
	public $timestamps = false;

	protected $casts = [
		self::ID => 'int',
		self::PORT => 'int',
		self::ICON => 'int',
		self::FLAG => 'int',
		self::TIMEZONE => 'int',
		self::ALLOWEDSECURITYLEVEL => 'int',
		self::POPULATION => 'float',
		self::GAMEBUILD => 'int'
	];

	protected $fillable = [
		self::NAME,
		self::ADDRESS,
		self::LOCALADDRESS,
		self::LOCALSUBNETMASK,
		self::PORT,
		self::ICON,
		self::FLAG,
		self::TIMEZONE,
		self::ALLOWEDSECURITYLEVEL,
		self::POPULATION,
		self::GAMEBUILD
	];
}
