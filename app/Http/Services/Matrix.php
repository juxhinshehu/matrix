<?php

declare(strict_types=1);

namespace App\Http\Services;

class Matrix 
{
	public function tranlateMatrixToCharacters(array $matrix): array 
	{
    	foreach ($matrix as $rowIndex => $row) {
    		foreach ($matrix as $colIndex => $col) {
    			$matrix[$rowIndex][$colIndex] = $this->getNameFromNumber($matrix[$rowIndex][$colIndex]);
    		}
    	}
    	return $matrix;
    	
    }

    public function getNameFromNumber(int $num): string 
    {
	    $numeric = ($num - 1) % 26;
	    $letter = chr(65 + $numeric);
	    $num2 = intval(($num - 1) / 26);
	    if ($num2 > 0) {
	        return $this->getNameFromNumber($num2) . $letter;
	    } else {
	        return $letter;
	    }
	}

	public function multiply(array $m1, array $m2): array
	{
		$size1 = count($m1);
		$m2Cols = count($m2[0]);
		$m1Cols = count($m1[0]);
		$size2 = count($m2);

		if ($m1Cols != $size2) { 
			throw new \Exception('Columns of the first matrix should be equal to the rows of the second');
		}
		
		$m3 = array();
		for ($i = 0; $i < $size1; $i++) {
			for ($j = 0; $j < $m2Cols; $j++) {
				$m3[$i][$j] = 0;
				for ($k = 0; $k < $size2; $k++) {
					$m3[$i][$j] += $m1[$i][$k] * $m2[$k][$j];
				}
			}
		}
		return $m3;
	}
}