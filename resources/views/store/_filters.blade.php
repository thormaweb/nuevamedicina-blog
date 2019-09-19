<div class="row">
    @push('scripts')
    <script>
        function insertParam(key, value) {
            key = encodeURI(key); value = encodeURI(value);
            let kvp = document.location.search.substr(1).split('&');
            let i = kvp.length; let x;

            while(i--) {
                x = kvp[i].split('=');

                if (x[0]==key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if(i<0) {
                kvp[kvp.length] = [key,value].join('=');
            }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }

        function removeParam(parameter)
        {
            let url = document.location.href;
            let urlparts = url.split('?');

            if (urlparts.length >= 2)
            {
                let urlBase = urlparts.shift();
                let queryString = urlparts.join("?");

                let prefix = encodeURIComponent(parameter)+'=';
                let pars = queryString.split(/[&;]/g);
                for (let i= pars.length; i-->0;)
                    if (pars[i].lastIndexOf(prefix, 0)!==-1)
                        pars.splice(i, 1);
                url = urlBase+'?'+pars.join('&');
                window.history.pushState('', document.title, url);

            }
            document.location.reload();
        }

        $('#setDestacado').on('click', function () {
            var isPresent = window.location.search.indexOf('destacado') > -1;

            if (isPresent) {
                removeParam('destacado');
            } else {
                insertParam('destacado', 1);
            }
        });

        $('.setRoom').on('click', function () {
            var room = $( this ).attr("data-room");

            if (room == '0') {
                removeParam('espacio');
            } else {
                insertParam('espacio', room);
            }
        });

        $('.setColor').on('click', function () {
            var room = $( this ).attr("data-color");

            if (room == '0') {
                removeParam('color');
            } else {
                insertParam('color', room);
            }
        });

    </script>
    @endpush
    <div class="col-md-10">
        <div class="filter">
            Ordenar por:
            <a id="setDestacado" class="sel @if(Request::has('destacado')) activeFilter @endif"><span class="closeFilter">x</span>  DESTACADOS</a>
            {{--<a href="" class="sel">RATING</a>--}}
        </div>

    </div>
    <div class="col-md-2">
        <div class="filter">
            {{--<a id="setEspacio" class="sel @if(Request::has('espacio')) activeFilter @endif"><span class="closeFilter">x</span>  ESPACIO</a>--}}
            {{--<a id="setColor" class="sel @if(Request::has('color')) activeFilter @endif"><span class="closeFilter">x</span>  ESPACIO</a>--}}
            <ul class="filter_nav">
                <li>Filtros:</li>
                <li class="dropdown">
                    <a data-room="0" data-toggle="dropdown" class="dropdown-toggle setRoom sel @if(Request::has('espacio')) activeFilter @endif" href=""><span class="closeFilter">x</span>  ESPACIO</a>
                    <ul class="dropdown-menu pull-right" id="espacios">
                        @inject('rooms', 'App\Room')
                        @foreach($rooms->ordered()->get() as $room)
                            <li><a data-room="{{ $room->id }}" class="setRoom @if(Request::get('espacio') == $room->id) activeFilterItem @endif">{{ $room->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-color="0" data-toggle="dropdown" class="dropdown-toggle setColor sel @if(Request::has('color')) activeFilter @endif" href=""><span class="closeFilter">x</span>  COLOR</a>
                    <ul class="dropdown-menu pull-right" id="colores">
                        @inject('colors', 'App\Color')
                        @foreach($colors->ordered()->get() as $color)
                            <li><a data-color="{{ $color->id }}" class="setColor @if(Request::get('color') == $color->id) activeFilterItem @endif"><img src="/images/colors/{{ $color->sample }}" alt="{{ $color->name }}"> {{ $color->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>