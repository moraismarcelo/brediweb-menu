<?php

namespace Brediweb\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Menu extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = ['titulo','texto','tipo','link','imagem','ativo','slug'];
    protected $appends = ['image_data', 'data_formatada'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'titulo'
            ]
        ];
    }

    public function paginas(){
        return $this->hasMany(Pagina::class)->where('ativo', '1')->orderBy('order', 'asc');
    }

    public function getDataFormatadaAttribute(){
        return Carbon::parse($this->attribute['created_at'])->format('d/m/Y');
    }

    public function getImageDataAttribute(){
        $tamanhos  = array_keys(config('menu.config.resolucao'));
        $sizeImage = [];

        if(count($tamanhos) > 0) {
            foreach($tamanhos as $tamanho) {
                $sizeImage[$tamanho] = route('imagem.render', config('menu.config.destino') . $tamanho . '/' . $this->imagem);
            }
        }

        return $sizeImage;

    }
}
