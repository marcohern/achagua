import { Component, OnInit } from '@angular/core';
import { GeocodeService } from '../geocode.service';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  constructor(private gs:GeocodeService) { }

  onSaving($event) {
    console.log("onSaving", $event);
  }

  onSaved() {
    console.log("onSaved");
  }

  ngOnInit() {
    
  }
}
