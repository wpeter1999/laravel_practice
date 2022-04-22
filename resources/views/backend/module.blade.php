@extends("layouts.layout")

@section('main')
    @include('layouts.backend_sidebar')
    <div class="main col-9 p-0 d-flex flex-wrap align-items-start">
        <div class="col-8 border py-3 text-center">後臺管理區</div>
        <button class="col-4 btn btn-light boder py-3 text-center">管理登出</button>
        <div class="border w-100 p-1" style="height:500px;overflow:auto;">
            <h5 class="text-center border-bottom py-3">

                @if ($module != 'total' && $module != 'bottom')
                    <button class="btn btn-sm btn-primary float-right" id="addrow">
                        新增
                    </button>
                @endif

                {{ $header }}
            </h5>
            <table class="table border-none text-center">
                <tr>
                    @isset($cols)
                        @if ($module != 'total' && $module != 'bottom')
                            @foreach ($cols as $col)
                                <td width="{{ $col }}">{{ $col }}</td>
                            @endforeach
                        @endif
                    @endisset
                </tr>
                @isset($rows)
                    @if ($module != 'total' && $module != 'bottom')
                        @foreach ($rows as $row)
                            <tr>
                                @foreach ($row as $item)
                                    <td>
                                        @switch ($item['tag'])
                                            @case('img')
                                                @include('layouts.img', $item)
                                            @break

                                            @case('button')
                                                @include('layouts.button', $item)
                                            @break

                                            @case('embed')
                                                @include('layouts.embed', $item)
                                            @break

                                            @case('textarea')
                                                @include('layouts.textarea', $item)
                                            @break

                                            @default
                                                {!! nl2br($item['text']) !!}
                                        @endswitch
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>{{ $cols[0] }}</td>
                            <td>{{ $rows[0]['text'] }}</td>
                            <td>@include('layouts.button', $rows[1])</td>
                        </tr>
                    @endif
                @endisset
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#addrow").on("click", function() {
            $.get("/modals/add{{ $module }}", function(modal) {
                $("#modal").html(modal)
                $("#baseModal").modal("show")

                //modal消失時清空記憶體與html
                $("#baseModal").on("hidden.bs.modal", function() {
                    $("#baseModal").modal("dispose")
                    $("#modal").html("")
                })
            })
        })

        $(".edit").on("click", function() {
            let id = $(this).data("id")
            $.get(`/modals/{{ $module }}/${id}`, function(modal) {
                $("#modal").html(modal)
                $("#baseModal").modal("show")

                //modal消失時清空記憶體與html
                $("#baseModal").on("hidden.bs.modal", function() {
                    $("#baseModal").modal("dispose")
                    $("#modal").html("")
                })
            })
        })

        $(".delete").on("click", function() {
            if (confirm('確認是否刪除?')) {
                let id = $(this).data("id")
                $.ajax({
                    type: 'delete',
                    url: `/admin/{{ $module }}/${id}`,
                    success: function() {
                        location.reload()
                    }
                })
            }
        })

        $(".show").on("click", function() {
            let id = $(this).data("id")
            $.ajax({
                type: "patch",
                url: `/admin/{{ $module }}/sh/${id}`,
                success: function() {
                    location.reload()
                }
            })
        })
    </script>
@endsection
