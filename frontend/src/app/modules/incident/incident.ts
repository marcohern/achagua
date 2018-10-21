export class Incident {
    id?:number;
    vbg:string = '';
    event_date:string;
    lat:number = 0;
    lng:number = 0;
    country_id:number;
    state_id:number;
    city_id:number;
    justice:boolean;
}
