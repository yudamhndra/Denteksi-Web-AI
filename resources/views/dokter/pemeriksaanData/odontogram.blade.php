<svg version="1.1" height="100%" width="100%" class="svgbox" style="display:block;">
    <g transform="scale(1)" class="gmain">
        @foreach($odontograms as $key => $odontogram)
            @php $x; $y; $i1 = 0; $i2 = 75; $i3 = 210; $yText @endphp
            @foreach($odontogram as $key2 => $odo)
            @switch($key)
                @case('b1k1')
                    @php $i1 += 25 ; $x = $i1; $y = 0; $yText = -3; @endphp
                    @break
                @case('b2k1')
                    @php $i2 += 25; $x = $i2; $y = 40; $yText = -3; @endphp
                    @break
                @case('b3k1')
                    @php $i2 += 25; $x = $i2; $y = 80; $yText = 30; @endphp
                    @break
                @case('b4k1')
                    @php $i1 += 25 ; $x = $i1; $y = 120; $yText = 30; @endphp
                    @break
                @case('b1k2')
                    @php $i3 += 25 ; $x = $i3; $y = 0; $yText = -3; @endphp
                    @break
                @case('b2k2')
                    @php $i3 += 25 ; $x = $i3; $y = 40; $yText = -3; @endphp
                    @break
                @case('b3k2')
                    @php $i3 += 25 ; $x = $i3; $y = 80; $yText = 30; @endphp
                    @break
                @case('b4k2')
                    @php $i3 += 25 ; $x = $i3; $y = 120; $yText = 30; @endphp
                    @break
            @endswitch
            <g id="{{$odo}}" transform="translate({{$x.','.$y}})">
                <polygon points="5,5 	15,5 	15,15 	5,15" fill="white" stroke="black" stroke-width="0.5" id="C" opacity="1"></polygon>
                <polygon points="0,0 	20,0 	15,5 	5,5" fill="white" stroke="black" stroke-width="0.5" id="T" opacity="1"></polygon>
                <polygon points="5,15 	15,15 	20,20 	0,20" fill="white" stroke="black" stroke-width="0.5" id="B" opacity="1"></polygon>
                <polygon points="15,5 	20,0 	20,20 	15,15" fill="white" stroke="black" stroke-width="0.5" id="R" opacity="1"></polygon>
                <polygon points="0,0 	5,5 	5,15 	0,20" fill="white " stroke="black" stroke-width="0.5" id="L" opacity="1"></polygon>
                <text x="6" y="{{$yText}}" stroke="black" fill="black" stroke-width="0.1" style="font-size: 6pt;font-weight:normal">{{substr($odo,1)}}</text>
            </g>
            @endforeach
        @endforeach
    </g>
</svg>

@push('after-script')
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>
    $(document).ready(function(){
        var rootSVGSize = d3.select("svg.svgbox").node().getBoundingClientRect()
        var dataLabelSize = d3.select("g.gmain").node().getBoundingClientRect()

        var x = (rootSVGSize.x - dataLabelSize.x) + (rootSVGSize.width - dataLabelSize.width) / 35;
        var y = (rootSVGSize.y - dataLabelSize.y) + (rootSVGSize.height - dataLabelSize.height) / 7;

        d3.select("g.gmain").attr("transform", "scale(1.75) translate(" + x + "," + y + ")");
    })

</script>
@endpush
