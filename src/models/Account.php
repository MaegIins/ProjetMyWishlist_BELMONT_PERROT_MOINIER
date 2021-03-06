<?php

namespace mywishlist\models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {
    protected $table = 'account';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function lists() {
        return $this->hasMany('\mywishlist\models\Liste', 'user_id')->get();
    }

    public function toArray() {
        return $this->getAttributes();
    }

    public function generateResetToken(Account $account) {
		// not implemented
    }
}