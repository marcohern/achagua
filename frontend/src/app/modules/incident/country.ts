import { State } from './state';

export class Country {
    id:number;
    code:string;
    name:string;
    lat:number = 0;
    lng:number = 0;
    zoom:number = 0;
    states?:State[] = null;
}
