<link href="{{ asset('vendor/makhweb/blade-x-loader/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/makhweb/blade-x-loader/css/app.js') }}"></script>

<script>
  const bladeXLoader = new BladeX({
  	rootID: {{ config('blade-x-loader.id') }}
  })

  bladeXLoader.init()
</script>