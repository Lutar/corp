<?php

namespace Corp\Http\Controllers;

use Corp\Menu;
use Corp\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Mail;
use Corp\Http\Requests;
use function Sodium\add;

class ContactsController extends SiteController
{

    public function __construct(MenusRepository $m_rep)
    {
        parent::__construct(new MenusRepository(new Menu()));
        $this->bar = 'left';
        $this->template = env('THEME').'.contacts';
    }

    public function index(Request $request)
    {

        if ($request->isMethod('post')) {

            $messages = [
                'required' => 'Атрибут :attribute является необходимым.',
                'email'    => 'Атрибут :attribute должен быть допустимым email адресом.',
            ];

            $this->validate($request, [
                'name'  => 'required|max:255',
                'email' => 'required|email',
                'message'  => 'required'
            ]/*,$messages*/);


            $data = $request->all();

            $result = Mail::send(env('THEME').'.email', ['data' => $data], function ($m) use ($data) {

                $m->from($data['email'], $data['name']);

                $m->to(env('MAIL_ADMIN'), 'Mr.Admin')->subject('Question');

            });

            if ($result) {
                return redirect()->route('contacts')->with('status', 'Email is send');
            }

        }

        $this->contentLeftBar = view(env('THEME').'.contactBar')
            ->render();

        $content = view(env('THEME').'.contact_content')
            ->render();
        $this->vars = array_add($this->vars, 'content', $content);


        return $this->renderOutput();

    }
}
