import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { SenhaPage } from './senha.page';

describe('SenhaPage', () => {
  let component: SenhaPage;
  let fixture: ComponentFixture<SenhaPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SenhaPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(SenhaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
