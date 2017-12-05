<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 09/09/2016
 * Time: 15:23
 */

namespace App\Core\fact_sismo;

use App\Core\Contracts\BaseRepositoryInterface;

class FactRepository implements BaseRepositoryInterface
{

    protected $fact_sismo;

    public function __construct()
    {
        $this->fact_sismo = new FactSismo();
    }

    public function cantidadSismos($pais_id)
    {
        return $registro = \DB::select('SELECT COUNT(*) as cant FROM fact_sismos WHERE fact_sismos.pais_id =' . $pais_id . '');
    }

    public function resumenMeses($pais_id)
    {
        return $registro = \DB::select('SELECT
	-- MONTHNAME(fact_sismos.fecha_sismo) as mes,
CASE WHEN MONTH(fact_sismos.fecha_sismo) = 1 THEN "enero"
WHEN MONTH(fact_sismos.fecha_sismo) = 2 THEN "febrero"
WHEN MONTH(fact_sismos.fecha_sismo) = 3 THEN "marzo"
WHEN MONTH(fact_sismos.fecha_sismo) = 4 THEN "abril"
WHEN MONTH(fact_sismos.fecha_sismo) = 5 THEN "mayo"
WHEN MONTH(fact_sismos.fecha_sismo) = 6 THEN "junio"
WHEN MONTH(fact_sismos.fecha_sismo) = 7 THEN "julio"
WHEN MONTH(fact_sismos.fecha_sismo) = 8 THEN "agosto"
WHEN MONTH(fact_sismos.fecha_sismo) = 9 THEN "septiembre"
WHEN MONTH(fact_sismos.fecha_sismo) = 10 THEN "octubre"
WHEN MONTH(fact_sismos.fecha_sismo) = 11 THEN "noviembre"
WHEN MONTH(fact_sismos.fecha_sismo) = 12 THEN "diciembre" END as mes,
	COUNT(*) num_sismos
FROM
	fact_sismos
WHERE
		fact_sismos.pais_id = ' . $pais_id . '
GROUP BY MONTH(fact_sismos.fecha_sismo)');
    }

    public function sismosFuertes()
    {
        return $registro = \DB::select('SELECT
	dim_paises.code,
	count(*) as num_sismos
FROM
	fact_sismos
INNER JOIN dim_paises on fact_sismos.pais_id = dim_paises.id
WHERE
	fact_sismos.mag BETWEEN 6
AND 10.5
GROUP BY dim_paises.code');
    }

    public function mapaPaises()
    {
        return $registro = \DB::select('SELECT * FROM fact_sismos
        ');
    }

    public function mapaPaisesDetail($pais_id)
    {
        return $registro = \DB::select('SELECT * FROM fact_sismos
        WHERE pais_id =' . $pais_id . '');
    }

    public function mapaPaisesIntens($inten_id)
    {
        return $registro = \DB::select('SELECT * FROM fact_sismos
        WHERE intensidad_id =' . $inten_id . '');
    }

    public function mapaPaisesIntensDetail($pais_id, $inten_id)
    {
        return $registro = \DB::select('SELECT * FROM fact_sismos
        WHERE pais_id =' . $pais_id . '
        AND intensidad_id =' . $inten_id . '
        ');
    }

    public function detalleSismo($sismo_id)
    {
        return $registro = \DB::select('SELECT
                                *
                            FROM
                                fact_sismos
                            INNER JOIN dim_paises
                            ON fact_sismos.pais_id = dim_paises.id
                            WHERE
                        	fact_sismos.id = ' . $sismo_id . '
        ');
    }

    public function resumenPaisesPorcen($pais_id)
    {
        return $registro = \DB::select('SELECT
	dim_intensidad.descripcion as name,
ROUND((COALESCE(
		(SELECT	COUNT(*)FROM fact_sismos WHERE fact_sismos.intensidad_id = dim_intensidad.id
			AND pais_id =' . $pais_id . ' ),0)*100)/(SELECT COUNT(*) FROM fact_sismos WHERE fact_sismos.pais_id=' . $pais_id . '),1) as y,
	dim_intensidad.descripcion as drilldown
FROM
	dim_intensidad');
    }

    public function resumenPaisesCantidad($pais_id)
    {
        return $registro = \DB::select('SELECT
	dim_intensidad.descripcion as name,
		(SELECT	COUNT(*)FROM fact_sismos WHERE fact_sismos.intensidad_id = dim_intensidad.id
			AND pais_id = ' . $pais_id . ') as y,
	dim_intensidad.descripcion as drilldown
FROM
	dim_intensidad');
    }

    public function resumenCategoriaPorcen($pais_id)
    {
        return $registro = \DB::select('SELECT
                                        dim_paises.nombre as name,
                                         ROUND((COALESCE(
                                            (
                                                SELECT
                                                    COUNT(*)
                                                FROM
                                                    fact_sismos
                                                WHERE
                                                    fact_sismos.intensidad_id = ' . $pais_id . '
                                                AND fact_sismos.pais_id = dim_paises.id
                                            ),0)*100)/(SELECT COUNT(*) FROM fact_sismos WHERE fact_sismos.intensidad_id=' . $pais_id . '),2) as y,
                                        dim_paises.nombre as drilldown
                                    FROM
                                        dim_paises
                                    ORDER BY
                                        dim_paises.id');
    }
    public function resumenCategoriaCantidad($pais_id)    {
        return $registro = \DB::select('SELECT
                                        dim_paises.nombre as name,
                                        COALESCE (
                                            (
                                                SELECT
                                                    COUNT(*)
                                                FROM
                                                    fact_sismos
                                                WHERE
                                                    fact_sismos.intensidad_id = ' . $pais_id . '
                                                AND fact_sismos.pais_id = dim_paises.id
                                            ),
                                            0
                                        ) as y,
                                        dim_paises.nombre as drilldown
                                    FROM
                                        dim_paises
                                    ORDER BY
                                        dim_paises.id ');
    }




    public function all()
    {

    }

    public function allEnProducto()
    {

    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function updated($id, array $attributes)
    {
        // TODO: Implement updated() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }


    public function deleted($id)
    {
        // TODO: Implement deleted() method.
    }

// añadir nueva categoria
    public function nuevaCategoria($inputs)
    {

    }

//    busqueda para editar categoria
    public function editarCategoria($id)
    {

    }

//    actualizar categoria
    public function actualizarCategoria($datos)
    {


    }

//    eliminar categoria: cambiar de estado
    public function eliminarCatego($id)
    {

    }

//    busqueda categoria
    public function busquedaCategoria($descripcion, $estado)
    {

    }

    public function ultimaCategoria()
    {

    }
}