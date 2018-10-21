import { Component, OnInit } from '@angular/core';
import { Incident } from '../incident';
import { IncidentsService } from '../incidents.service';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  constructor(private is:IncidentsService) { }

  onSaving($event) {

    console.log("onSaving", $event);
    var $incident = $event.value;

    var inc:Incident = {
      vbg: $incident.vbg,
      event_date: '' + $incident.year + '-01-01',
      lat: 0,
      lng: 0,
      country_id: 57,
      state_id: parseInt($incident.state),
      city_id: parseInt($incident.city),
      justice: $incident.justice
    };

    this.is.create(inc).subscribe(result => {
      console.log(result);
    }, error => {
      console.error(error);
    });
  }

  ngOnInit() {
    
  }
}
