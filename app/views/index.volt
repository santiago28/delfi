<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
        {{ stylesheet_link('css/style.css') }}
        {{ stylesheet_link('css/theme.default.css') }}
        {{ stylesheet_link('css/theme.bootstrap.css') }}
        {{ assets.outputCss() }}
        {{ javascript_include('js/jquery-2.2.4.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/utils.js') }}
		{{ javascript_include('js/jquery.tablesorter.js') }}
		{{ javascript_include('js/jquery.tablesorter.widgets.js') }}
		{{ javascript_include('js/parsley.min.js') }}
		{{ javascript_include('js/bootstrap-filestyle.min.js') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>
    <body>
        {{ content() }}
        {{ assets.outputJs() }}
    </body>
</html>
