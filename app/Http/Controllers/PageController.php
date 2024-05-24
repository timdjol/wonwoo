<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Country;
use App\Models\Live;
use App\Models\Page;
use App\Models\Region;
use Goutte\Client;
use Illuminate\Http\Request;


class PageController extends Controller
{
    private $titles = array();

    public function delivery()
    {
        $page = Page::get()[0];
        return view('pages.delivery', compact('page'));
    }

    public function payment()
    {
        $page = Page::get()[1];
        return view('pages.payment', compact('page'));
    }

    public function refund()
    {
        $page = Page::get()[2];
        return view('pages.refund', compact('page'));
    }

    public function about()
    {
        $page = Page::get()[3];
        return view('pages.about', compact('page'));
    }

    public function contacts()
    {
        $page = Page::get()[4];
        $contacts = Contact::get();
        return view('pages.contacts', compact('page', 'contacts'));
    }

    public function policy()
    {
        $page = Page::get()[5];
        return view('pages.policy', compact('page'));
    }

    public function personal_data()
    {
        $page = Page::get()[7];
        return view('pages.personal', compact('page'));
    }

    public function live()
    {
        $page = Page::get()[6];
        return view('pages.lives', compact('page'));
    }



    public function liveform(Request $request)
    {
        $params = $request->all();
        //dd($params);
        Live::create($params);
        session()->flash('success', 'Заявка отправлена');
        return redirect()->route('lives');
    }

    public function success_page(){
        return view('pages.success');
    }

    public function failure_page(){
        return view('pages.failure');
    }

    public function scrapper ()
    {

        $client = new Client();
        $url = 'https://aliexpress.ru/category/24/mobile-phones-accessories.html?spm=a2g2w.productlist.categorylist.1.17a94aa6pEId4R&source=nav_category';
        $page = $client->request('GET', $url);
        $page->filter('.product-snippet_ProductSnippet__container__w6hatm')->each(function ($item){
            $this->titles[$item->filter('.product-snippet_ProductSnippet__name__w6hatm')->text()] = $item->filter('.product-snippet_ProductSnippet__name__w6hatm')->text();
        });

        $titles = $this->titles;

        //$prices = $this->prices;

        return view('pages.scrapper', compact('titles'));

    }
    public function fetchState(Request $request)
    {
        $data['states'] = Region::where("country_id", $request->country_id)->get(["title", "id"]);
        return response()->json($data);
    }
}