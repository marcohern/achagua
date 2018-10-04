import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'incident-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {

  
  lat: number = 3.441816;
  lng: number = -76.516484;
  defRadius: number = 1000;
  defOpacity:number = 0.3;
  amount:number = 20;

  circles:any[] = [];
  
  constructor() { }

  private rnd(range:number) {
    var half = range/2;
    return half*(Math.random() - 0.5);
  }

  ngOnInit() {
    var locRadiusCoor = 0.25;
    var circRadiusMt = 2000;
    var opacityRange = 0.6;
    this.circles = [];
    for (let i =0; i<this.amount;i++) {
      var lat = this.lat + this.rnd(locRadiusCoor);
      var lng = this.lng + this.rnd(locRadiusCoor);
      var radius = this.defRadius + this.rnd(circRadiusMt);
      var opacity = this.defOpacity + this.rnd(opacityRange);
      this.circles.push({
        lat: lat, lng:lng, radius:radius, opacity:opacity
      });
    }
  }

}
