<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <?php
  $meta = array(
    'title' => '2014 Fort Hood shooting timeline',
    'description' => 'An Army report released Friday revealed new details about the April 2014 shooting at Fort Hood in which Spc. Ivan López killed three fellow soldiers and wounded 16 before killing himself.',
    'thumbnail' => 'http://projects.statesman.com/news/fort-hood-timeline/assets/share.jpg',
    'url' => 'http://projects.statesman.com/news/fort-hood-timeline/',
    'twitter' => 'statesman'
  );
?>

  <title>Interactive: <?php print $meta['title']; ?> | Austin American-Statesman</title>
  <link rel="icon" type="image/png" href="//projects.statesman.com/common/favicon.ico">

  <link rel="canonical" href="<?php print $meta['url']; ?>" />

  <meta name="description" content="<?php print $meta['description']; ?>">

  <meta property="og:title" content="<?php print $meta['title']; ?>"/>
  <meta property="og:description" content="<?php print $meta['description']; ?>"/>
  <meta property="og:image" content="<?php print $meta['thumbnail']; ?>"/>
  <meta property="og:url" content="<?php print $meta['url']; ?>"/>

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@<?php print $meta['twitter']; ?>" />
  <meta name="twitter:title" content="<?php print $meta['title']; ?>" />
  <meta name="twitter:description" content="<?php print $meta['description']; ?>" />
  <meta name="twitter:image" content="<?php print $meta['thumbnail']; ?>" />
  <meta name="twitter:url" content="<?php print $meta['url']; ?>" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="dist/style.css">

  <link rel="stylesheet" href="http://cartodb-libs.global.ssl.fastly.net/cartodb.js/v3/themes/css/cartodb.css">
  <script src="http://cartodb.github.io/odyssey.js/vendor/modernizr-2.6.2.min.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Lusitana:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,300,300italic,400italic,700italic,700,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="http://www.statesman.com/" target="_blank">
          <img width="273" height="26" src="assets/logo.png">
        </a>
      </div>
       <ul class="nav navbar-nav navbar-right social hidden-xs">
          <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode($meta['url']); ?>"><i class="fa fa-facebook-square"></i></a></li>
          <li><a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo urlencode($meta['url']); ?>&via=<?php print urlencode($meta['twitter']); ?>&text=<?php print urlencode($meta['title']); ?>"><i class="fa fa-twitter"></i></a></li>
          <li><a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($meta['url']); ?>"><i class="fa fa-google-plus"></i></a></li>
        </ul>
    </div>
  </nav>

  <div id="map" style="width: 100%; height: 100%;"></div>

  <div id="slides_container" style="display:block;">
    <div id="dots"></div>

    <div id="slides"></div>

    <ul id="navButtons">
      <li><a class="prev"></a></li>
      <li><a class="next"></a></li>
    </ul>
  </div>

  <div id="credits">
    <span class="title" id="title">Title</span>
    <span class="author"><strong id="author">By Name using</strong> <a href="http://cartodb.github.io/odyssey.js/">Odyssey.js</a><span>
    </span></span></div>

    <script src="http://cartodb-libs.global.ssl.fastly.net/cartodb.js/v3/cartodb.js"></script>
    <script src="http://cartodb.github.io/odyssey.js/dist/odyssey.js" charset="UTF-8"></script>

    <script>
    var resizePID;

    function clearResize() {
      clearTimeout(resizePID);
      resizePID = setTimeout(function() { adjustSlides(); }, 100);
    }

    if (!window.addEventListener) {
      window.attachEvent("resize", function load(event) {
        clearResize();
      });
    } else {
      window.addEventListener("resize", function load(event) {
        clearResize();
      });
    }

    function adjustSlides() {
      var container = document.getElementById("slides_container"),
      slide = document.querySelectorAll('.selected_slide')[0];

      if (slide) {
        if (slide.offsetHeight+169+40+80 >= window.innerHeight) {
          container.style.bottom = "80px";

          var h = container.offsetHeight;

          slide.style.height = h-169+"px";
          slide.classList.add("scrolled");
        } else {
          container.style.bottom = "auto";
          container.style.minHeight = "0";

          slide.style.height = "auto";
          slide.classList.remove("scrolled");
        }
      }
    }

    var resizeAction = O.Action(function() {
      function imageLoaded() {
        counter--;

        if (counter === 0) {
          adjustSlides();
        }
      }
      var images = $('img');
      var counter = images.length;

      images.each(function() {
        if (this.complete) {
          imageLoaded.call( this );
        } else {
          $(this).one('load', imageLoaded);
        }
      });
    });

    function click(el) {
      var element = O.Core.getElement(el);
      var t = O.Trigger();

      // TODO: clean properly
      function click() {
        t.trigger();
      }

      if (element) element.onclick = click;

      return t;
    }

    O.Template({
      init: function() {
        var seq = O.Triggers.Sequential();

        //var baseurl = this.baseurl = 'http://{s}.api.cartocdn.com/base-light/{z}/{x}/{y}.png';
        var baseurl = this.baseurl = 'http://otile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg';
        var map = this.map = L.map('map', {zoomControl: false}).setView([31.1375, -97.7886], 17);
        new L.Control.Zoom({ position: 'topright' }).addTo(map);
        var basemap = this.basemap = L.tileLayer(baseurl, {
          attribution: 'data OSM - map CartoDB'
        }).addTo(map);

        // enanle keys to move
        O.Keys().on('map').left().then(seq.prev, seq)
        O.Keys().on('map').right().then(seq.next, seq)

        click(document.querySelectorAll('.next')).then(seq.next, seq)
        click(document.querySelectorAll('.prev')).then(seq.prev, seq)

        var slides = O.Actions.Slides('slides');
        var story = O.Story()

        this.story = story;
        this.seq = seq;
        this.slides = slides;
        this.progress = O.UI.DotProgress('dots').count(0);
      },

      update: function(actions) {
        var self = this;

        if (!actions.length) return;

        this.story.clear();

        if (this.baseurl && (this.baseurl !== actions.global.baseurl)) {
          //this.baseurl = actions.global.baseurl || 'http://0.api.cartocdn.com/base-light/{z}/{x}/{y}.png';
          this.baseurl = actions.global.baseurl || 'http://otile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg';

          this.basemap.setUrl(this.baseurl);
        }

        if (this.cartoDBLayer && ("http://"+self.cartoDBLayer.options.user_name+".cartodb.com/api/v2/viz/"+self.cartoDBLayer.options.layer_definition.stat_tag+"/viz.json" !== actions.global.vizjson)) {
          this.map.removeLayer(this.cartoDBLayer);

          this.cartoDBLayer = null;
          this.created = false;
        }

        if (actions.global.vizjson && !this.cartoDBLayer) {
          if (!this.created) { // sendCode debounce < vis loader
            cdb.vis.Loader.get(actions.global.vizjson, function(vizjson) {
              self.map.fitBounds(vizjson.bounds);

              cartodb.createLayer(self.map, vizjson)
              .done(function(layer) {
                self.cartoDBLayer = layer;

                var sublayer = layer.getSubLayer(0),
                layer_name = layer.layers[0].options.layer_name,
                filter = actions.global.cartodb_filter ? " WHERE "+actions.global.cartodb_filter : "";

                sublayer.setSQL("SELECT * FROM "+layer_name+filter)

                self.map.addLayer(layer);

                self._resetActions(actions);
              }).on('error', function(err) {
                console.log("some error occurred: " + err);
              });
            });

            this.created = true;
          }

          return;
        }

        this._resetActions(actions);
      },

      _resetActions: function(actions) {
        var sl = actions;

        document.getElementById('slides').innerHTML = ''
        this.progress.count(sl.length);

        // create new story
        for(var i = 0; i < sl.length; ++i) {
          var slide = sl[i];
          var tmpl = "<div class='slide'>";

            tmpl += slide.html();
            tmpl += "</div>";
            document.getElementById('slides').innerHTML += tmpl;

            this.progress.step(i).then(this.seq.step(i), this.seq)

            var actions = O.Parallel(
            this.slides.activate(i),
            slide(this),
            this.progress.activate(i),
            resizeAction
            );

            actions.on("finish.app", function() {
              adjustSlides();
            });

            this.story.addState(
            this.seq.step(i),
            actions
            )
          }

          this.story.go(this.seq.current());
        },

        changeSlide: function(n) {
          this.seq.current(n);
        }
      });
    </script>

<script id="md_template" type="text/template">```
-title: "2014 Fort Hood shooting timeline"
-author: "Andrew Chavez / American-Statesman"
```

#Fort Hood shooting timeline
```
L.marker([31.136306, -97.786589]).actions.addRemove(S.map)
L.marker([31.136555, -97.788986]).actions.addRemove(S.map)
L.marker([31.137735, -97.791962]).actions.addRemove(S.map)
L.marker([31.137679, -97.790191]).actions.addRemove(S.map)
L.marker([31.137841, -97.788773]).actions.addRemove(S.map)
L.marker([31.138215, -97.788415]).actions.addRemove(S.map)
L.marker([31.138401, -97.787754]).actions.addRemove(S.map)
L.marker([31.137031, -97.786527]).actions.addRemove(S.map)
- center: [31.1375, -97.7886]
- zoom: 17
```
*Interactive by Andrew Chavez, Austin American-Statesman*

An Army report released Friday revealed new details about the April 2014 shooting at Fort Hood in which Spc. Ivan López killed three fellow soldiers and wounded 16 others before killing himself.

Our timeline draws from the report, which presents the most comprehensive timeline to date of the day's events.

**Use the arrows below to navigate.**

#Shooting begins
```
- center: [31.136306, -97.786589]
- zoom: 17
L.marker([31.136306, -97.786589]).actions.addRemove(S.map)
```

López arrives at Building 39001 to discuss a time-off request. According to the report, he "verbally attacked" someone then left the building.

About 4:15 p.m., after making a few phone calls and sending a text message, López begins shooting, woudning four in an office before shooting several rounds through the door of a conference room, fatally wounding Sgt. First Class Danny Ferguson. After firing eleven rounds, he gets in his car and drives west.

#Roadside shooting
```
- center: [31.136555, -97.788986]
- zoom: 17
L.marker([31.136555, -97.788986]).actions.addRemove(S.map)
```

While driving away from Building 39001, López stops to shoot at someone standing at the side of the road. He shoots three times, wounding the person once.

#Building 40027
```
- center: [31.137735, -97.791962]
- zoom: 17
L.marker([31.137735, -97.791962]).actions.addRemove(S.map)
```

López parks outside the a motor pool and enters Building 40027. He heads straight to an office where he shoots once, missing his intended target and grazing someone else's head.

He fires several more rounds inside the office and in an attached bay, killing Sgt. Timothy Owens and wounding three others. He tries to shoot another person while exiting, but his gun misifires. He fired a total of nine rounds before getting back in his car.

#Jeep shooting
```
- center: [31.137679, -97.790191]
- zoom: 17
L.marker([31.137679, -97.790191]).actions.addRemove(S.map)
```

While driving away from the motor pool, López stops alongside a stopped vehicle and shoots a single round through the Jeep's window. The glass from the shot wounded the soldier inside.

#Drive-by shootings
```
- center: [31.138156, -97.788688]
- zoom: 17
L.marker([31.137841, -97.788773]).actions.addRemove(S.map)
L.marker([31.138215, -97.788415]).actions.addRemove(S.map)
```
López shoots three times through the passensger-side window of his truck, then turns into the parking lot of the medical brigade and shoots once out the driver-side window, wounding a soldier in the neck.

#Medical brigade shootings
```
- center: [31.138401, -97.787754]
- zoom: 17
L.marker([31.138401, -97.787754]).actions.addRemove(S.map)
```
López parks in front of the medical brigade building and walks in the front doors. He shoots at three soldiers in the office next to the doors, killing one and wounding two. He walks down the buidling's main hallway, shooting one more person as he leaves.

He gets back in his car and drives out of the parking lot.

#López commits suicide
```
- center: [31.137031, -97.786527]
- zoom: 17
L.marker([31.137031, -97.786527]).actions.addRemove(S.map)
```
López gets out of his car and begins to walk back toward Building 39001, where the shooting began. On the way, he's confronted by military police.

“You better kill me now … I was the shooter … kill me,” he told military officers, according to the report.

Moments later, López removes his pistol from his waistband and fatally shoots himself.</script>
</body>
</html>
