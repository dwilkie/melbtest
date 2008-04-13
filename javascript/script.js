/*
  FILE: script.js

  Scripts for Melbourne Testing Services Website

  Notes:
  This page validates to XHTML strict.

  Author:
  David Wilkie (dwilkie@gmail.com)

  Modified:
  Version 0.1; 2008-04-13 Added Google Maps Integration. - DCW
  todo:
   Add driving directions
  */
function openWindow(url)
{
  window.open(url);
  return false;
}

function load_map()
{
  if (GBrowserIsCompatible())
  {
    //html to display in info window
    var infoHtml = "<strong>Melbourne Testing Services</strong><br />Unit 1/15 Pickering Rd<br />Mulgrave, Victoria 3170<br />Mel Ref: 71 A10<br />(03) 9560 2759";
    
    //create the map and centre it
    var map = new GMap2(document.getElementById("map_canvas"));
    
    map.setCenter(new GLatLng(-37.907166, 145.154282), 15);
    
    //create the marker and add it
    var point = new GLatLng(-37.907166, 145.154282);
    var marker = new GMarker(point);
    
    map.addOverlay(marker);
    
    //create the info window
    marker.openInfoWindowHtml(infoHtml);
    
    //add a map control (zoomer)
    map.addControl(new GLargeMapControl());
    
    //add map control (map type)
    var bottomRight = new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,10));
    map.addControl(new GMapTypeControl(), bottomRight);
    
    //display info window when user clicks marker
    GEvent.addListener(marker, "click", function()
    {
      map.openInfoWindowHtml(point, infoHtml);
    }
    );
  }
}