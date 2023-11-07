<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes, Translatable;

    protected $fillable = ['code', 'title', 'category_id', 'description', 'hit', 'new',
        'recommend', 'title_en', 'description_en', 'image', 'param', 'vendor', 'price', 'count', 'price_sale'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

//    public function skus(){
//        return $this->hasMany(Sku::class);
//    }
//
//    public function properties(){
//        return $this->belongsToMany(Property::class, 'property_product')->withTimestamps();
//    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'images');
    }

    public function scopeByCode($query, $code){
        return $query->where('code', $code);
    }

    public function scopeHit($query){
        return $query->where('hit', 1);
    }
    public function scopeNew($query){
        return $query->where('new', 1);
    }
    public function scopeRecommend($query){
        return $query->where('recommend', 1);
    }

    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value){
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isHit(){
        return $this->hit === 1;
    }

    public function isNew(){
        return $this->new === 1;
    }

    public function isRecommend(){
        return $this->recommend === 1;
    }

//    public function isAvailable(){
//        return !$this->product->trashed() && $this->count > 0;
//    }

    public function getPriceForCount(){
        if(!is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    /* получить цену в валюте сессии */
    public function getPriceAttribute($value) {
        return round(CurrencyConversion::convert($value), 0);
    }

    /* получить цену в данной валюте */
    public function getPriceInCurrency(Currency $currency) {
        return round(CurrencyConversion::convert($this->price,  CurrencyConversion::getCurrentCurrencyFromSession()
            ->code, $currency->code), 0);
    }

}
