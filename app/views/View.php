<?php

declare(strict_types=1);

namespace App\Views;

class View
{
	public function render(string $page, array $params = []): void
	{
		$params = $this->escape($params);
		require_once("./app/views/template/$page.php");
	}

	public function escape(array $params): array
	{
		$clearParams = [];
		
		foreach ($params as $key => $param) {
            switch (true) {
                case is_array($param):
                $clearParams[$key] = $this->escape($param);
                break;
                case is_int($param):
                $clearParams[$key] = $param;
                case is_float($param):
                $clearParams[$key] = $param;
                break;
                case $param:
                $clearParams[$key] = htmlentities($param);
                break;
                default:
                $clearParams[$key] = $param;
                break;
            }
		}

		return $clearParams;
	}
}