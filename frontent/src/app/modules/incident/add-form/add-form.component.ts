import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  olat: number = 3.441816;
  olng: number = -76.516484;
  lat: number;
  lng: number;
  constructor() { }

  ngOnInit() {
    this.lat = this.olat;
    this.lng = this.olng;
  }

  onClickMap($event) {
    console.log("map",$event);
    this.lat = $event.coords.lat;
    this.lng = $event.coords.lng;
  }

}
