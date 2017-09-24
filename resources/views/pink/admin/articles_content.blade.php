@if($articles)
    <div id="content-page" class="content group">
        <div class="hentry group">
            <h2>Добавленные статьи</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th class="align-left">Заголовок</th>
                        <th class="align-left">Текст</th>
                        <th class="align-left">Изоображение</th>
                        <th class="align-left">Категория</th>
                        <th class="align-left">Псевдоним</th>
                        <th class="align-left">Действие</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="align-left">{{ $article->id }}</td>
                            <td class="align-left">{!! Html::link(route('admin.articles.edit', ['articles', $article->alias]), $article->title) !!}</td>
                            <td class="align-left">{!! str_limit($article->text, 200) !!}</td>
                            <td class="align-left">
                                @if(isset($article->img->mini))
                                    {!! Html::image(asset(env('THEME').'/images/articles/'.$article->img->mini)) !!}
                                @endif
                            </td>
                            <td class="align-left">{{ $article->category->title }}</td>
                            <td class="align-left">{{ $article->alias }}</td>
                            <td class="align-left">
                                {!! Form::open(['url' => route('admin.articles.destroy', ['articles' => $article->alias]), 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                                    {{ method_field('DELETE') }}
                                    {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! HTML::link(route('admin.articles.create'),'Добавить  материал',['class' => 'btn btn-the-salmon-dance-3']) !!}
        </div>
    <!-- START COMMENTS -->
        <div id="comments">
        </div>
        <!-- END COMMENTS -->
    </div>
@endif