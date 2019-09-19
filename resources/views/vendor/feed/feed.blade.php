<?=
    /* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
    '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
        @foreach($items as $item)
        <item>
            <title><![CDATA[{{ $item->title }}]]></title>
            <link rel="alternate" href="{{ url($item->link) }}" />
            <id>{{ url($item->id) }}</id>
            <media:content type="image/jpg" url="{{ url($item->media) }}"></media:content>
            <author>
                <name> <![CDATA[{{ $item->author }}]]></name>
            </author>
            <summary type="html">
                <![CDATA[{!! $item->summary !!}]]>
            </summary>
            <updated>{{ $item->updated->toAtomString() }}</updated>
        </item>
        @endforeach
    </channel>
</rss>