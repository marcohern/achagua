import { State } from "./state";

export class City {
    id:number;
    state_id:number;
    name:string;
    lat:number = 0;
    lng:number = 0;
    zoom:number = 0;
    state?:State = null;
}
