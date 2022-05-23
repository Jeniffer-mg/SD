import { Component, OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';

export interface Estudiante {
  id: number;
  nota: number;
  periodo: number;
  nombre: string;
  apellido: string;
}

@Component({
  selector: 'app-teacher-view',
  templateUrl: './teacher-view.component.html',
  styleUrls: ['./teacher-view.component.scss']
})

export class TeacherViewComponent implements OnInit {
  displayedColumns: string[] = ['nombre', 'apellido', 'nota', 'periodo'];
  dataSource:Estudiante[] = [];
  constructor(private requestService: RequestService) {
    // this is empty intentionally
  }

  async ngOnInit() {
    this.dataSource = await this.requestService.getStudents() as Estudiante[];
  }

}
