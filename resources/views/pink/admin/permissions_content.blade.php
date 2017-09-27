<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Привилегии</h3>
        <form action="{{ route('admin.permissions.store') }}" method="post">
            {{ csrf_field() }}
            <div class="short-table white">
                <table style="width: 100%">
                    <thead>
                    <th>Привилегии</th>
                    @if($roles)
                        @foreach($roles as $role)
                            <th>{{ $role->name }}</th>
                        @endforeach
                    @endif
                    </thead>

                    <tbody>
                    @if($priv)
                        @foreach($priv as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @foreach($roles as $role)
                                    @if($role->hasPermission($permission->name))
                                        <td><input checked name="" type="checkbox" value=""/></td>
                                    @else
                                        <td><input name="" type="checkbox" value=""/></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <input class="btn btn-the-salmon-dance-3" type="submit" value="Обновить"/>
            </div>
        </form>
    </div>
</div>
