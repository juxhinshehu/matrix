<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Matrix;

class MatrixController extends Controller
{
    /**
	 * Multiply 2 matrixes and return result as string
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Http\Services\Matrix $matrixService
	 * @return \Illuminate\Http\Response
	 */
    public function multiply(Request $request, Matrix $matrixService)
    {
    	$data = $request->all();
    	$matrix1Cols = count($data['matrix1'][0]);
		$request->validate([
		    'matrix1' => 'required',
		    'matrix2' => 'required|size:'.$matrix1Cols
		],
		[
			'matrix2.size' => "Columns of the first matrix should be equal to the rows of the second"
		]);

		$multiplicated = $matrixService->multiply($data['matrix1'], $data['matrix2']);
		$translated = $matrixService->tranlateMatrixToCharacters($multiplicated);
		
        return response()->json($translated);
    }
}
