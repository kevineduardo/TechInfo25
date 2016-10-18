<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use Illuminate\View\View;
use App\Page;
use App\Calendar;
use App\Picture;
use App\Setting;
use App\News;

class CachePages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera cache das paginas e.e';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->armazenar();
    }

    private function armazenar()
    {
        $fotos = Picture::all();
        $calendario = Calendar::take(4)->get();
        $this->colocarEmCache('início', view('inicio', ['calendario' => $calendario, 'fotos' => $fotos,])->render() , 'início');
        $paginas = Page::all();
        foreach ($paginas as $key) {
            $pagina = Page::with('author')->with('editor')->find($key->id);
            if($pagina) {
                $this->colocarEmCache('páginas:' . $key->id, view('pagina', $pagina)->render() , 'páginas');
            }
        }
        $configs = Setting::all();
        $this->colocarEmCache('settings', $configs, 'settings');
        $this->info('Paginas cacheadas. Tudo numa boa.');
        $noticias = News::all();
        $this->colocarEmCache('notícias', $noticias, 'notícias');
        $this->info('Noticias cacheadas tambem. Why not?');
    }
    private function colocarEmCache($key, $content, $tag)
    {
        \Cache::tags($tag)->put($key, $content, Carbon::now()->addMinutes(30));
    }
}
