import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {VacationsService} from '../vacations.service';
import {Vacation} from '../types';

@Component({
  selector: 'app-edit-vacation-page',
  templateUrl: './edit-vacation-page.component.html',
  styleUrls: ['./edit-vacation-page.component.css']
})
export class EditVacationPageComponent implements OnInit {
  vacation: Vacation | any;
  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private vacationsService: VacationsService,
  ) { }

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id != null) {
      this.vacationsService.getVacationById(id)
        .subscribe(vacation => this.vacation = vacation);
    }

  }

  // @ts-ignore
  onSubmit({city, country, description, targets, cost}): void {
    this.vacationsService.editVacation(this.vacation.id, city, country, description, targets, cost)
      .subscribe( () => {
        this.router.navigateByUrl('/my-vacations');
      });
  }

}
