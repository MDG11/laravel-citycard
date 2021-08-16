<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class UserController extends Controller
{
/**
 * @OA\Post(
 * summary="Pay",
 * path="/pay",
 * description="Pay with terminal",
 * operationId="pay",
 * tags={"pay"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass data",
 *    @OA\JsonContent(
 *       required={"price","card","vehicle"},
 *       @OA\Property(property="price", type="integer", format="number", example="100"),
 *       @OA\Property(property="card", type="object", example="{'id':1,'card_code':'TSDQKBO0','balance':0,'user_id':null,'card_type_id':2,'created_at':'2021-08-15T23:27:19.000000Z','updated_at':'2021-08-15T23:27:19.000000Z'}"),
 *       @OA\Property(property="vehicle", type="object", example="{'id':1,'licence_plate_number':'BG6966JE','vehicle_type_id':2,'created_at':'2021-08-15T23:27:19.000000Z','updated_at':'2021-08-15T23:27:19.000000Z','city_id':1}"),
 *    ),
 * ),
 * @OA\Response(
 *    response=201,
 *    description="Payed for the ride, created new Ride",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Everything is good, thanks for using our API")
 *        ),
 *     ),
 *  @OA\Response(
 *    response=401,
 *    description="Unauthenticated",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Unauthenticated card")
 *        ),
 *     ),
 * )
*/
    public function pay(Request $request)
    {
        return Vehicle::first();
    }
}
