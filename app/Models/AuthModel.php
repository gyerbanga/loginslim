<?php

namespace App\Models;

use \FaaPz\PDO\Database as FaaPz;

class AuthModel extends FaaPz
{
	public function hydrate($data)
	{
		if ($data) :
			// $this->data = $data;
			foreach ($data as $key => $value) :
				$this->$key = $value;
			endforeach;
			if (isset($data[$this->primaryKey]) && is_numeric($data[$this->primaryKey])) :
				$this->isNew = false;
			endif;
		endif;
	}

	public function get_primaryKey()
	{
		return $this->primaryKey;
	}

	/**
	 * Sert à récupérer les données à insérer dans une balise html <select>
	 * @param  string $value   Le nom du champ qui sera utilisé comme valeur dans le <select>
	 * @param  string $text    Le nom du champ qui sera utilisé comme texte affiché dans le <select>
	 * @param  array  $options
	 * @return array Un tableau de données où chaque entrée est une option du <select> (value => text)
	 */
	public function get_select(string $value, string $text, array $options = [])
	{
		if (isset($options['where'])) :
			foreach ($options['where'] as $where) :
				$this->where(
					$where['field'],
					$where['value'],
					isset($where['operator']) ? $where['operator'] : '='
				);
			endforeach;
		endif;

		if (isset($options['orderby'])) :
			$orderby = isset($options['orderby']['field']) ? $options['orderby']['field'] : $fields[1];
			$this->orderBy($orderby, $options['orderby']['sort']);
		endif;

		$return = [];
		$data = $this->get(null, [$value, $text]);
		foreach ($data as $item) :
			$return[$item->$value] = isset($options['field.text']) ? $item->{$options['field.text']} : $item->$text;
		endforeach;
		return $return;
	}

	public function set_orderby_for_dt(array $order, array $columns)
	{
		$count = count($order);
		for ($i = 0; $i < $count; $i++) :
			$column = $order[$i]['column'];
			$field  = $columns[$column]['name'];
			$dir    = $order[$i]['dir'];
			$this->orderBy($field, $dir);
		endfor;
	}

	public function set_limit_for_dt(int $start, int $length)
	{
		return $start || $length ? [$start, $length] : null;
	}
}
