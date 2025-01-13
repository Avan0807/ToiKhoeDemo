<?php
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />

    <div class="container mt-5 border">
      <!-- Doctor Info Section -->
      <div class="row align-items-center">
        <!-- Phần hình ảnh và đánh giá -->
        <div class="col-md-4 pt-3 text-center">
          <img
            style="height: 250px; width: 250px"
            src="https://th.bing.com/th/id/OIP.j11Gs00ZaERMgw07f7NvQgHaHa?rs=1&pid=ImgDetMain"
            class="rounded-circle img-fluid shadow"
            alt="Doctor Image"
          />
          <h3 class="mt-3">Bác sĩ Lê Công Định</h3>
          <p class="text-muted">(Tai - Mũi - Họng)</p>
          <div class="mt-2">
            <span class="text-warning fs-4">
              &#9733; &#9733; &#9733; &#9733; &#9734;
            </span>
            <p class="mt-1 fw-semibold">4.0 out of 5</p>
          </div>
        </div>

        <!-- Phần thông tin -->
        <div class="col-md-8">
          <div class="card p-4">
            <h4 class="text-primary pb-3">Contact Information</h4>
            <p>
              <i class="fas fa-map-marker-alt"></i>
              <strong>Địa chỉ công tác:</strong> Bệnh viện Bạch Mai
            </p>
            <p>
              <i class="fas fa-envelope"></i>
              <strong>Email:</strong> doctor.email@example.com
            </p>
            <p>
              <i class="fas fa-phone"></i> <strong>Số điện thoại:</strong> +1
              234 567 890
            </p>

            <h4 class="text-primary pb-3">About the Doctor</h4>
            <p>
              Dr. Sweta Gupta is a highly skilled gynecologist with over 20
              years of experience in IVF, fertility treatments, and managing
              high-risk pregnancies. Her compassionate care and innovative
              approach have earned her the trust of countless patients.
            </p>
          </div>
          <div class="row mt-3">
            <div class="col-md-12 text-center">
              <button class="btn btn-primary me-2">Contact Now</button>
              <button class="btn btn-success me-2">Book Appointment</button>
              <button class="btn btn-warning">Chat</button>
            </div>
          </div>
          <!-- <div class="card p-4 mt-3">
            <h4 class="text-primary">About the Doctor</h4>
            <p>
              Dr. Sweta Gupta is a highly skilled gynecologist with over 20
              years of experience in IVF, fertility treatments, and managing
              high-risk pregnancies. Her compassionate care and innovative
              approach have earned her the trust of countless patients.
            </p>
          </div> -->
        </div>
      </div>

      <!-- Work experience -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card p-3">
            <h4>Work Experience</h4>
            <div class="row">
              <div class="col-md-6 ps-4">
                <h5>Experience Year</h5>
                <ul>
                  <li>1984 - 1990: sinh viên trường Đại học Y Hà Nội</li>
                  <li>
                    1990 - 1993: Bác sỹ nội trú Tai mũi họng tại bộ môn Tai mũi
                    họng trường Đại học Y Hà Nội
                  </li>
                  <li>
                    1995 - 1996: đào tạo theo chương trình bác sỹ nội trú Tai
                    Mũi Họng tại Trung tâm viện trường Đại học Lille - Cộng hòa
                    Pháp.
                  </li>
                  <li>
                    Đào tạo chuyên khoa sâu Tai thần kinh tại tại Trung tâm viện
                    trường Đại học Lille - Cộng hòa Pháp.
                  </li>
                </ul>
              </div>
              <div class="col-md-6 border-start ps-4">
                <h5>Expert Skills</h5>
                <ul>
                  <li>
                    Chuyên sâu về các bệnh lý mũi xoang, phẫu thuật nội soi mũi
                    xoang và nền sọ
                  </li>
                  <li>
                    Chuyên sâu về các bệnh lý Tai, Tai thần kinh và phẫu thuật
                    Tai
                  </li>
                  <li>Skill 3</li>
                  <li>Skill 4</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Nav Tabs with Available Slots -->
      <div class="row justify-content-center mt-5">
        <div class="col-md-8">
          <ul class="nav nav-tabs" id="doctorTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="info-tab"
                data-bs-toggle="tab"
                data-bs-target="#info"
                type="button"
                role="tab"
                aria-controls="info"
                aria-selected="true"
              >
                Doctor Info
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="timing-tab"
                data-bs-toggle="tab"
                data-bs-target="#timing"
                type="button"
                role="tab"
                aria-controls="timing"
                aria-selected="false"
              >
                Timing
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="fee-tab"
                data-bs-toggle="tab"
                data-bs-target="#fee"
                type="button"
                role="tab"
                aria-controls="fee"
                aria-selected="false"
              >
                Fee
              </button>
            </li>
          </ul>
          <div class="tab-content" id="doctorTabsContent">
            <div
              class="tab-pane fade show active"
              id="info"
              role="tabpanel"
              aria-labelledby="info-tab"
            >
              <div class="mt-3 ps-2">
                <h5>Doctor Information</h5>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                  Praesent id dolor dui, dapibus gravida elit.
                </p>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="timing"
              role="tabpanel"
              aria-labelledby="timing-tab"
            >
              <div class="mt-3 ps-2">
                <h5>Timing</h5>
                <p>Monday - Friday: 10:00 AM - 5:00 PM</p>
                <p>Saturday: 10:00 AM - 2:00 PM</p>
                <p>Sunday: Closed</p>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="fee"
              role="tabpanel"
              aria-labelledby="fee-tab"
            >
              <div class="mt-3 ps-2">
                <h5>Consultation Fee</h5>
                <p>$100 for the first consultation.</p>
                <p>$80 for follow-ups.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h5>Find Available Time Slots</h5>
            <form>
              <div class="mb-3">
                <label for="slot-date" class="form-label">Select Date</label>
                <input type="date" id="slot-date" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="slot-time" class="form-label"
                  >Available Slots</label
                >
                <select id="slot-time" class="form-select">
                  <option>10:00 AM - 10:30 AM</option>
                  <option>11:00 AM - 11:30 AM</option>
                  <option>2:00 PM - 2:30 PM</option>
                  <option>4:00 PM - 4:30 PM</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success w-100">
                Check Availability
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Booking Section -->
      <div class="row mt-4">
        <div class="col-md-4">
          <div class="card p-3">
            <h5>Book an Appointment</h5>
            <form>
              <div class="mb-3">
                <label for="date" class="form-label">Select Date</label>
                <input type="date" id="date" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="time" class="form-label">Select Time</label>
                <select id="time" class="form-select">
                  <option>10:00 AM</option>
                  <option>2:00 PM</option>
                  <option>4:00 PM</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary w-100">
                Book Now
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card p-3">
            <h5>Details and Timings</h5>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
              nec venenatis lorem, vitae pharetra erat.
            </p>
          </div>
        </div>
      </div>

      <!-- Location Section -->
      <div class="row mt-4">
        <div class="col-md-12">
          <h5>Location</h5>
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.08381827292!2d-122.08185802437267!3d37.386051979730885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb24b0d4295a7%3A0x6e253a420a2445f6!2sGoogleplex!5e0!3m2!1sen!2sus!4v1671293561092!5m2!1sen!2sus"
            width="100%"
            height="300"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="row mt-4">
        <div class="col-md-12">
          <h5>FAQ</h5>
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                >
                  What is IVF?
                </button>
              </h2>
              <div
                id="collapseOne"
                class="accordion-collapse collapse show"
                aria-labelledby="headingOne"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body">
                  IVF stands for In-Vitro Fertilization. It is a process to help
                  with fertility or prevent genetic issues.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                  aria-expanded="false"
                  aria-controls="collapseTwo"
                >
                  How to book an appointment?
                </button>
              </h2>
              <div
                id="collapseTwo"
                class="accordion-collapse collapse"
                aria-labelledby="headingTwo"
                data-bs-parent="#faqAccordion"
              >
                <div class="accordion-body">
                  You can use the form above to book an appointment by selecting
                  the date and time.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Related Section -->
      <
      <div class="row mt-4">
        <div class="col-md-12">
          <h5>Related Doctors</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <img
                  src="https://via.placeholder.com/200"
                  class="card-img-top rounded-circle mx-auto mt-3"
                  alt="Doctor Image"
                />
                <div class="card-body text-center">
                  <h6 class="card-title">Dr. John Doe</h6>
                  <p class="text-muted">Cardiologist</p>
                  <button class="btn btn-primary btn-sm">View Profile</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <img
                  src="https://via.placeholder.com/200"
                  class="card-img-top rounded-circle mx-auto mt-3"
                  alt="Doctor Image"
                />
                <div class="card-body text-center">
                  <h6 class="card-title">Dr. Jane Smith</h6>
                  <p class="text-muted">Pediatrician</p>
                  <button class="btn btn-primary btn-sm">View Profile</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <img
                  src="https://via.placeholder.com/200"
                  class="card-img-top rounded-circle mx-auto mt-3"
                  alt="Doctor Image"
                />
                <div class="card-body text-center">
                  <h6 class="card-title">Dr. Emily Brown</h6>
                  <p class="text-muted">Dermatologist</p>
                  <button class="btn btn-primary btn-sm">View Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>