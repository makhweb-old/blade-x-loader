<link href="{{ asset('vendor/makhweb/blade-x-loader/css/app.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/makhweb/blade-x-loader/js/app.js') }}"></script>

<script>
  const bladeXLoader = new BladeXLoader({
  	rootID: '{{ config('blade-x-loader.id') }}',
  	tagAttr: '{{ config('blade-x-loader.tag_attribute') }}',
    cacheAttr: '{{ config('blade-x-loader.cache_attribute') }}',
    NProgressConfig: @json(config('blade-x-loader.nprogress_config'))
  })

  bladeXLoader.init()
</script>