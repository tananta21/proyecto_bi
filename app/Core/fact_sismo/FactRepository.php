<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 09/09/2016
 * Time: 15:23
 */

namespace App\Core\fact_sismo;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Core\fact_sismo\FactSismo;

class FactRepository implements BaseRepositoryInterface
{

    protected $fact_sismo;

    public function __construct()
    {
        $this->fact_sismo = new FactSismo();
    }

    public function resumenMeses($pais_id)
    {
        return $registro = \DB::select('SELECT
                                            dim_tiempo.mes,
                                            COUNT(*) num_sismos
                                        FROM
                                            fact_sismos
                                        INNER JOIN dim_tiempo
                                        ON fact_sismos.tiempo_id = dim_tiempo.id
                                            WHERE
                                                fact_sismos.pais_id = '.$pais_id.'
                                        GROUP BY dim_tiempo.mes
                                        ORDER BY MONTH(dim_tiempo.fecha_completa)');
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