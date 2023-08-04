<?php
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    /**
     * @var mixed|string
     */
    public mixed $error_type;
    /**
     * @var mixed|string
     */
    public mixed $error_message;
    /**
     * @var mixed|string
     */
    public mixed $error_trace;

    protected $guarded = [];

    public mixed $request_id;

    protected $fillable = ['request_id','error_type','error_message','error_trace'];

}
