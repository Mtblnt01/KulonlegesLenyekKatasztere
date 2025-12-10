import { TestBed } from '@angular/core/testing';

import { Creatures } from './creatures';

describe('Creatures', () => {
  let service: Creatures;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(Creatures);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
