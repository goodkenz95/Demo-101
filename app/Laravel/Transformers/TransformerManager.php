<?php 

namespace App\Laravel\Transformers;

use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Serializer\DataArraySerializer;
use Illuminate\Database\Eloquent\RelationNotFoundException;

class TransformerManager
{
	public function transform($data, $transformer, $type = 'item', $custom_includes = NULL)
	{
		$request = Request();
		$manager = new Manager();
		$manager->setSerializer(new DataArraySerializer());

		if($request->has('include')) {
			$includes = str_replace(" ", "", $request->get('include'));
		    $manager->parseIncludes($includes);
		}

		if(strlen($custom_includes)){
				$includes = str_replace(" ", "", $custom_includes);
			    $manager->parseIncludes($includes);	
		}

		if($type == 'item') {
			$resource = new Item($data, $transformer);
		}
		else {
			$resource = new Collection($data, $transformer);
		}
		
		$data = $manager->createData($resource)->toArray();

		// We want to return data key
		return $data['data'];
	}
}

