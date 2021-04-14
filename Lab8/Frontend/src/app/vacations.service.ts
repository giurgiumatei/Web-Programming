import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable} from 'rxjs';
import {Vacation} from './types';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
  })
};

@Injectable({
  providedIn: 'root'
})
export class VacationsService {

  constructor(
    private http: HttpClient,
  ) { }

  getVacations(): Observable<Vacation[]>{
    return this.http.get<Vacation[]>('http://localhost/backend-get-all.php');
  }

  getVacationById(id: string): Observable<Vacation> {
    return this.http.get<Vacation>(`http://localhost/backend-get-by-id.php?id=${id}`);
  }


  deleteVacation(id: string): Observable<any> {
    return this.http.get(`http://localhost/backend-delete-destinations.php?id=${id}`);
  }

  createVacation(city: string, country: string, description: string, targets: string, cost: string): Observable<Vacation>{
    return this.http.post<Vacation>(
      'http://localhost/backend-add-destinations.php',
      {city, country, description, targets, cost },
      httpOptions,
    );
  }

  editVacation(id: any, city: string, country: string, description: string, targets: string, cost: string): Observable<Vacation>{
    return this.http.post<Vacation>(
      `http://localhost/backend-update-destinations.php?id=${id}`,
      {id, city, country, description, targets, cost },
      httpOptions,
    );
  }
}
