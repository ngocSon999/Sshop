@if($categoryPrent->categoryChildrent->count())
    <ul role="menu" class="sub-menu">
        @foreach($categoryPrent->categoryChildrent as $categoryChildrent )
            <li>
                <a href="{{route('web.categoryProduct',[
                'slug'=>$categoryChildrent->slug,
                'id'=>$categoryChildrent->id
                ])}}">
                    {{$categoryChildrent->name}}
                </a>
                @if($categoryChildrent->categoryChildrent->count())
                    @include('web.components.menu_categoy',['categoryPrent'=>$categoryChildrent])
                @endif
            </li>
        @endforeach
    </ul>
@endif
