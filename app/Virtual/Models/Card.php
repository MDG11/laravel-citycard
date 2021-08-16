<?php
/**
 * @OA\Schema(
 *     title="Card",
 *     description="Card model",
 *     @OA\Xml(
 *         name="Card"
 *     )
 * )
 */
class Project
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Card Code",
     *      description="Card unique code",
     *      example="PLVMVWSNM9D"
     * )
     *
     * @var string
     */
    public $card_code;

    /**
     * @OA\Property(
     *      title="Balance",
     *      description="Card balance",
     *      example="100"
     * )
     *
     * @var string
     */
    public $balance;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *      title="User ID",
     *      description="User's id of card",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $user_id;


    /**
     * @OA\Property(
     *     title="User",
     *     description="Card user model"
     * )
     *
     * @var \App\Virtual\Models\User
     */
    private $user;

    /**
     * @OA\Property(
     *     title="Rides",
     *     description="Card's rides model"
     * )
     *
     * @var \App\Virtual\Models\Ride
     */
    private $rides;
    /**
     * @OA\Property(
     *     title="Card Type",
     *     description="Cards type"
     * )
     *
     * @var \App\Virtual\Models\Card_Type
     */
    private $card_type;
}