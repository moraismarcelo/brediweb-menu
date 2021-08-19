<?php

namespace Brediweb\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Pagina extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = ['pagina_id','menu_id','titulo','descricao','texto','data','link','imagem','ativo','order','slug'];
    protected $appends = ['data_formatada', 'image_data'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'titulo'
            ]
        ];
    }


    public function menu(){
      return $this->belongsTo(Menu::class);
    }

    public function paginas(){
        return $this->hasMany(Pagina::class)->orderBy('order');
      }

    public function getDataFormatadaAttribute(){
      return Carbon::parse($this->attribute['created_at'])->format('d/m/Y');
    }

    public function getImageDataAttribute(){
        $tamanhos  = array_keys(config('menu.configPagina.resolucao'));
        $sizeImage = [];

        if(count($tamanhos) > 0) {
            foreach($tamanhos as $tamanho) {
                $sizeImage[$tamanho] = route('imagem.render', config('menu.configPagina.destino') . $tamanho . '/' . $this->imagem);
            }
        }

        return $sizeImage;

    }
}
