import { City } from "./city";
import { Country } from "./country";

export class State {
    id:number;
    name:string;
    country_id:number;
    lat:number = 0;
    lng:number = 0;
    zoom:number = 0;
    cities?:City[] = null;
    country?:Country = null;
}
