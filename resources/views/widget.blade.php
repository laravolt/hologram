<div {!! $attributes !!} data-page="1">
    <div class="ui card fluid">
        <div class="content">
            <div class="header">@lang('hologram::widget.title')</div>
        </div>

        @include('hologram::items', compact('logs'))

        <div class="extra content">
            <button class="ui button basic fluid" type="submit" data-no-more-content="@lang('hologram::widget.no_more_content')" data-url="{{ route('hologram::index') }}">@lang('hologram::widget.load_more')</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#{{ $id }}').on('click', 'button[type=submit]', function(e){
            e.preventDefault();
            var hologram = $(e.delegateTarget);
            var btn = $(e.currentTarget);
            if (btn.hasClass('disabled')) {
                return false;
            }
            btn.addClass('loading disabled');
            var logContainer = $(e.delegateTarget).find('.hologram-list');
            hologram.data('page', parseInt(hologram.data('page')) + 1);
            var param = jQuery.extend({}, hologram.data());
            var url = btn.data('url');
            delete param.url;
            $.ajax({
                type: "GET",
                url: url + '?' + decodeURIComponent($.param(param)),
                success: function (html) {
                    if (html.length > 0) {
                        $(html).insertBefore(hologram.find('.extra.content'));
                        btn.removeClass('disabled');
                    } else {
                        btn.attr("disabled", "disabled").html(btn.data('no-more-content'));
                    }
                },
                error: function () {
                    alert('Something goes wrong');
                },
                complete: function () {
                    btn.removeClass('loading');
                }
            });
            return false;
        });
    });
</script>
