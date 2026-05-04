<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id_asistencia
 * @property int $id_funcionario
 * @property \Illuminate\Support\Carbon $fecha_asis_ini
 * @property \Illuminate\Support\Carbon|null $fecha_asis_fin
 * @property string|null $observaciones
 * @property-read \App\Models\Funcionario $funcionario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia whereFechaAsisFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia whereFechaAsisIni($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia whereIdAsistencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia whereIdFuncionario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asistencia whereObservaciones($value)
 */
	class Asistencia extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_cargo
 * @property string $descripcion
 * @property bool|null $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cargo whereIdCargo($value)
 */
	class Cargo extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Producto> $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereUpdatedAt($value)
 */
	class Categoria extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_dependencia
 * @property string $nombre
 * @property string|null $descripcion
 * @property bool|null $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia whereIdDependencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dependencia whereNombre($value)
 */
	class Dependencia extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string|null $telefono
 * @property string $cargo
 * @property numeric $sueldo
 * @property \Illuminate\Support\Carbon|null $fecha_ingreso
 * @property bool $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $nombre_completo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereSueldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Empleado withoutTrashed()
 */
	class Empleado extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_funcionario
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $sexo
 * @property string|null $telefono
 * @property \Illuminate\Support\Carbon|null $fecha_nacimiento
 * @property string $ci
 * @property int|null $id_vinculo
 * @property int|null $id_cargo
 * @property int|null $id_dependencia
 * @property bool|null $estado_activo
 * @property-read \App\Models\Cargo|null $cargo
 * @property-read \App\Models\Dependencia|null $dependencia
 * @property-read string $nombre_completo
 * @property-read \App\Models\Vinculo|null $vinculo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereApellidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereCi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereEstadoActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereIdCargo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereIdDependencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereIdFuncionario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereIdVinculo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Funcionario whereTelefono($value)
 */
	class Funcionario extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_movimiento
 * @property int|null $id_activo
 * @property int|null $id_tipo_movimiento
 * @property int|null $id_funcionario_origen
 * @property int|null $id_funcionario_destino
 * @property int|null $id_ubicacion_destino
 * @property string|null $fecha_movimiento
 * @property string|null $observaciones
 * @property-read \App\Models\Producto|null $producto
 * @property-read \App\Models\User|null $usuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereFechaMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdFuncionarioDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdFuncionarioOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdTipoMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereIdUbicacionDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Movimiento whereObservaciones($value)
 */
	class Movimiento extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_permiso_ausencia
 * @property int $id_funcionario
 * @property int $id_permiso
 * @property \Illuminate\Support\Carbon $fecha_ini
 * @property \Illuminate\Support\Carbon $fecha_fin
 * @property string|null $observaciones
 * @property string|null $hora_ini
 * @property string|null $hora_fin
 * @property int|null $dias_habiles
 * @property string|null $justificacion
 * @property string|null $estado
 * @property int|null $registrado_por
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Funcionario $funcionario
 * @property-read \App\Models\User|null $registradoPor
 * @property-read \App\Models\TipoPermiso $tipoPermiso
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereDiasHabiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereFechaIni($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereHoraFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereHoraIni($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereIdFuncionario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereIdPermiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereIdPermisoAusencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereJustificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereObservaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PermisoAusencia whereRegistradoPor($value)
 */
	class PermisoAusencia extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property string|null $descripcion
 * @property int $categoria_id
 * @property int $stock
 * @property numeric $precio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Categoria $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movimiento> $movimientos
 * @property-read int|null $movimientos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto stockBajo(int $umbral = 5)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto withoutTrashed()
 */
	class Producto extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_rol
 * @property string $descripcion
 * @property bool|null $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rol whereIdRol($value)
 */
	class Rol extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_permiso
 * @property string $descripcion
 * @property bool|null $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TipoPermiso whereIdPermiso($value)
 */
	class TipoPermiso extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_usuario
 * @property string $nombre
 * @property string $pass
 * @property int|null $id_rol
 * @property bool|null $activo
 * @property-read \App\Models\Rol|null $rol
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema whereIdRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema whereIdUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UsuarioSistema wherePass($value)
 */
	class UsuarioSistema extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_vinculo
 * @property string $descripcion
 * @property bool|null $activo
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vinculo whereIdVinculo($value)
 */
	class Vinculo extends \Eloquent {}
}

